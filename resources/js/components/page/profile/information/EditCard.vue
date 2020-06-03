<template>
  <v-container>
    <v-row>
      <v-col>
        <v-card class="mx-auto ma-4">
          <v-container>
            <v-row justify="space-between">
              <v-col cols="auto" class="profile-picture-container">
                <v-img
                    height="200"
                    width="200"
                    :src="user.avatar ? `/storage/${user.avatar}` : '/images/site/default_avatar.jpg'"
                ></v-img>
                <v-btn @click="avatarModalIsOpen = true">
                  Change Avatar
                </v-btn>
              </v-col>
              <v-col>
                <ValidationObserver
                    ref="profileEditObserver"
                    v-slot="{ invalid }"
                >
                  <form>
                    <v-container>
                      <v-row>
                        <v-col>
                          <ValidationProvider v-slot="{ errors }" name="username"
                                              rules="required|max:255|uniqueUsername">
                            <v-text-field
                                v-model="form.username"
                                :label="$t('username')"
                                :error-messages="errors"
                                required
                            />
                          </ValidationProvider>
                        </v-col>
                      </v-row>

                      <v-row>
                        <v-col>
                          <ValidationProvider v-slot="{ errors }" name="name" rules="required|max:255">
                            <v-text-field
                                v-model="form.name"
                                :label="$t('name')"
                                :error-messages="errors"
                                required
                            />
                          </ValidationProvider>
                        </v-col>
                      </v-row>

                      <v-row>
                        <v-col>
                          <ValidationProvider v-slot="{ errors }" name="email" rules="required|email|uniqueEmail">
                            <v-text-field
                                v-model="form.email"
                                :label="$t('email')"
                                :error-messages="errors"
                                type="email"
                                required
                            />
                          </ValidationProvider>
                        </v-col>
                      </v-row>

                      <v-row>
                        <v-col>
                          {{ user.created_at }}
                        </v-col>
                      </v-row>

                      <v-row>
                        <v-col>
                          <v-btn
                              color="success"
                              class="mr-4"
                              :disabled="invalid"
                              :loading="form.busy"
                              @click="edit"
                          >
                            {{ $t('submit') }}
                          </v-btn>
                          <v-btn
                              color="error"
                              class="mr-4"
                              @click="resetForm"
                          >
                            {{ $t('reset') }}
                          </v-btn>
                        </v-col>
                      </v-row>
                    </v-container>
                  </form>
                </ValidationObserver>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
    <ImageCropper
        :modalIsOpen="avatarModalIsOpen"
        @modalBackgroundClicked="avatarModalIsOpen = false"
        @imageCropped="uploadAvatar"
    />
  </v-container>
</template>

<script>
  import {ADD_MESSAGE} from '~/store/mutation-types'
  import {mapGetters} from 'vuex'

  export default {
    name: 'ProfileEditCard',
    props: {
      user: {
        type: Object,
        required: true
      }
    },
    data: () => ({
      avatarModalIsOpen: false,
      form: {
        name: null,
        username: null,
        email: null,
      }
    }),
    computed: {
      ...mapGetters({
        vxUser: 'auth/user'
      }),
    },
    created() {
      this.form.name = this.vxUser.name
      this.form.username = this.vxUser.username
      this.form.email = this.vxUser.email
    },
    methods: {
      uploadAvatar(image) {
        this.avatarModalIsOpen = false
        this.$store.dispatch('auth/uploadAvatar', image)
      },
      resetForm() {
        this.form.name = ''
        this.form.email = ''
        this.$refs.profileEditObserver.reset()
      },
      async edit() {
        // Edit the user.
        await this.$store.dispatch('auth/editUser', {editForm: this.form})
            .then(async (data) => {
              this.$store.commit(`flash/${ADD_MESSAGE}`, {
                level: 'success',
                body: this.$t('profile.edit.success'),
                isAutoRemove: true
              })
            })
      }
    }
  }
</script>
