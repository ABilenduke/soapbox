<template>
  <v-container fluid>
      <v-row dense>
        <v-col>
          <ValidationObserver
            ref="registerObserver"
            v-slot="{ invalid }"
          >
            <form>
              <v-container>
                <v-sheet class="pa-12">
                  <v-row>
                    <v-col cols="12">
                      <h1>
                        {{ $t('register.title') }}
                      </h1>
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col cols="12">
                      <ValidationProvider v-slot="{ errors }" name="name" rules="required|max:255">
                        <v-text-field
                          v-model="form.name"
                          :label="$t('name')"
                          :error-messages="errors"
                          required
                        />
                      </ValidationProvider>
                    </v-col>

                    <v-col cols="12">
                      <ValidationProvider v-slot="{ errors }" name="username" rules="required|max:255|uniqueUsername">
                        <v-text-field
                          v-model="form.username"
                          :label="$t('username')"
                          :error-messages="errors"
                          required
                        />
                      </ValidationProvider>
                    </v-col>

                    <v-col cols="12">
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

                    <v-col cols="12">
                      <ValidationProvider
                        v-slot="{ errors }"
                        name="password"
                        rules="required|max:255|confirmed:confirmation"
                      >
                        <v-text-field
                          v-model="form.password"
                          :label="$t('password')"
                          :error-messages="errors"
                          type="password"
                          required
                        />
                      </ValidationProvider>
                    </v-col>

                    <v-col cols="12">
                      <ValidationProvider
                        v-slot="{ errors }"
                        name="password_confirmation"
                        rules="required|max:255"
                        vid="confirmation"
                      >
                        <v-text-field
                          v-model="form.password_confirmation"
                          :label="$t('password_confirmation')"
                          :error-messages="errors"
                          type="password"
                          required
                        />
                      </ValidationProvider>
                    </v-col>

                    <v-col cols="12">
                      <v-btn
                        color="success"
                        class="mr-4"
                        :disabled="invalid"
                        :loading="form.busy"
                        @click="register"
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
                </v-sheet>
              </v-container>
            </form>
          </ValidationObserver>
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
import { ADD_MESSAGE } from '~/store/mutation-types'

export default {
  name: 'AuthRegisterView',
  middleware: 'guest',
  metaInfo () {
    return { title: this.$t('register.title') }
  },
  data: () => ({
    form: {
      name: '',
      username: '',
      email: '',
      password: '',
      password_confirmation: '',
    }
  }),
  methods: {
    async register () {
      // Register the user.
      await this.$store.dispatch('auth/registerUser', { registerForm: this.form })
        .then(async (data) => {
          // Must verify email fist.
          if (data.status) {
            this.$store.commit(`flash/${ ADD_MESSAGE }`, {
              level: 'warning',
              body: this.$t('register.messages.verify'),
              isAutoRemove: false
            })
          } else {
            // Log in the user.
            await this.$store.dispatch('auth/loginUser', { loginForm: this.form })
              .then(async ({ data: { token } }) => {
                // Save the token.
                this.$store.dispatch('auth/saveToken', { token })
                // Update the user.
                await this.$store.dispatch('auth/updateUser', { user: data })
              })
          }
          // Redirect home.
          this.$router.push({ name: 'home' })
        })
    },
    resetForm() {
      this.form.name = ''
      this.form.username = ''
      this.form.email = ''
      this.form.password = ''
      this.form.password_confirmation = ''
      this.$refs.registerObserver.reset()
    },
  }
}
</script>