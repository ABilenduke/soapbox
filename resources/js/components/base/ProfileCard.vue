<template>
  <v-card v-if="userCopy" class="mx-auto text-shadow" max-width="400" height="225">
    <v-img
      height="100%"
      :src="`https://cdn.andrewbilenduke.com/resume/soapbox/${userCopy.profile_background}`"
    >
      <v-row align="end">
        <v-col align-self="start" class="pa-0" cols="5">
          <v-avatar class="profile" color="grey" size="135" tile>
            <v-img :src="userCopy.avatar"></v-img>
          </v-avatar>
        </v-col>

        <v-col align-self="start" justify="end" class="pa-0" cols="7">
          <div class="card-content-container">{{ userCopy.description }}</div>
        </v-col>
      </v-row>

      <v-row align="end">
        <v-col class="py-0">
          <v-list-item color="rgba(0, 0, 0, .4)" dark>
            <v-list-item-content>
              <v-list-item-title
                class="title"
                link
                :to="`/profile/${userCopy.username}`"
              >{{ userCopy.name }}</v-list-item-title>
              <v-list-item-subtitle
                link
                :to="`/profile/${userCopy.username}`"
              >{{ userCopy.username }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-col>

        <v-col>
          <v-row justify="end" align="end">
            <v-col cols="4">
              <v-menu offset-y :close-on-click="closeOnClick">
                <template v-slot:activator="{ on }">
                  <v-btn v-on="on" icon>
                    <v-icon>mdi-dots-horizontal</v-icon>
                  </v-btn>
                </template>

                <v-list>
                  <v-list-item>
                    <template v-if="userCopy.is_followed">
                      <v-list-item-action>
                        <v-icon>mdi-account-minus</v-icon>
                      </v-list-item-action>
                      <v-list-item-content>
                        <v-btn class="pa-0" @click="unFollowUser()" text>
                          {{ $t('unfollow') }}
                        </v-btn>
                      </v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-action>
                        <v-icon>mdi-account-plus</v-icon>
                      </v-list-item-action>
                      <v-list-item-content>
                        <v-btn class="pa-0" @click="followUser()" text>
                          {{ $t('follow') }}
                        </v-btn>
                      </v-list-item-content>
                    </template>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-action>
                      <v-icon>mdi-account-cancel</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                      <v-list-item-title>{{ $t('block') }}</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-action>
                      <v-icon>mdi-alert</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                      <v-list-item-title>{{ $t('report') }}</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-list>
              </v-menu>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-img>
  </v-card>
</template>

<script>
import axios from "axios";
import moment from "moment";
import { mapGetters } from "vuex";

export default {
  name: "ProfileCard",
  props: {
    closeOnClick: true,
    user: {
      type: Object,
      required: true
    }
  },
  data: () => ({
    userCopy: null
  }),
  computed: {
    ...mapGetters({
      vxIsAuthUser: "auth/check"
    })
  },
  created() {
    this.userCopy = this.user;
  },
  methods: {
    joinedAt() {
      const joinedMoment = new moment(this.user.created_at).fromNow();
      return `${this.$t("joined")}: ${joinedMoment}`;
    },
    followUser() {
      if (!this.vxIsAuthUser) {
        this.$router.push("/register");
      } else {
        axios
          .post(`/api/profile/follow/${this.userCopy.username}`)
          .then(response => {
            this.userCopy.is_followed = true;
            console.log(response);
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
    unFollowUser() {
      if (!this.vxIsAuthUser) {
        this.$router.push("/register");
      } else {
        axios
          .delete(`/api/profile/follow/${this.userCopy.username}`)
          .then(response => {
            this.userCopy.is_followed = false;
            console.log(response);
          })
          .catch(error => {
            console.error(error);
          });
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.text-shadow {
  text-shadow: 1px 1px #000000;
}
.profile-picture-container {
  background-color: #f1f2f3;
  border-radius: 5px;
}
.card-content-container {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-content: center;
  align-items: center;

  border-radius: 10px;

  margin: 0 15px;

  &:hover {
    background-color: rgba(255, 255, 255, 0.3);
    cursor: pointer;
  }

  .card-content {
    display: flex;
    justify-content: center;
    align-content: center;
    align-items: center;

    padding: 15px;

    &.header {
      font-weight: 800;
      font-size: 24px;
    }
    &.sub-header {
      font-size: 22px;
      font-weight: 600;
    }
  }
}
</style>
