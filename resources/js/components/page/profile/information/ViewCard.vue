<template>
  <v-container>
    <v-row>
      <v-col>
        <v-card class="mx-auto ma-4">
          <v-container>
            <v-row justify="space-between">
              <v-col cols="auto" class="profile-picture-container">
                <v-img height="400" width="400" :src="vxUser.avatar" />
              </v-col>
              <v-col class="py-0">
                <v-container class="pa-0">
                  <v-row>
                    <v-col>
                      <h4>
                        {{ $t('username') }}
                      </h4>
                      <h5 class="pl-3">
                        {{ vxUser.username }}
                      </h5>
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col>
                      <h4>
                        {{ $t('name') }}
                      </h4>
                      <h5 class="pl-3">
                        {{ vxUser.name }}
                      </h5>
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col>
                      <h4>
                        {{ $t('description') }}
                      </h4>
                      <h5 class="pl-3" v-if="vxUser.description">
                        {{ vxUser.description }}
                      </h5>
                      <h5 v-else class="pl-3">
                        {{ $t('addDescription') }}
                      </h5>
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col>
                      <h4>
                        {{ $t('hometown') }}
                      </h4>
                      <h5 class="pl-3"></h5>
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col>
                      <h4>
                        {{ $t('currentLocation') }}
                      </h4>
                      <h5 class="pl-3"></h5>
                    </v-col>
                  </v-row>

                  <v-row>
                    <v-col>
                      <h4>
                        {{ $t('joined') }}
                      </h4>
                      <!-- <h5 class="pl-3">
                        {{ joinedAt() }}
                      </h5> -->
                      </v-col>
                  </v-row>
                </v-container>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { ADD_MESSAGE } from "~/store/mutation-types";
import { mapGetters } from "vuex";

export default {
  name: "ProfileViewCard",
  data: () => ({}),
  computed: {
    ...mapGetters({
      vxUser: "profile/user"
    })
  },
  methods: {
    uploadAvatar(image) {
      this.avatarModalIsOpen = false;
      this.$store.dispatch("auth/uploadAvatar", image);
    },
    resetForm() {
      this.form.name = "";
      this.form.email = "";
      this.$refs.profileEditObserver.reset();
    },
    async edit() {
      // Edit the user.
      await this.$store
        .dispatch("auth/editUser", { editForm: this.form })
        .then(async data => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: "success",
            body: this.$t("profile.edit.success"),
            isAutoRemove: true
          });
        });
    },
    joinedAt() {
      // return new moment(this.vxUser.created_at).fromNow()
    }
  }
};
</script>
