<template>
  <v-card v-if="userCopy" class="mx-auto ma-4">
    <v-card-title>
      <v-btn
        link
        :to="`/profile/${userCopy.username}`"
        text
      >
        {{ userCopy.username }}
      </v-btn>

      <v-spacer />

      <v-btn
        v-if="userCopy.is_followed"
        @click="unFollowUser()"
        text
      >
        <v-icon>mdi-account-minus</v-icon>
        <span class="button-span">
          {{ $t('unfollow') }}
        </span>
      </v-btn>

      <v-btn
        v-else
        @click="followUser()"
        text
      >
        <v-icon>mdi-account-plus</v-icon>
        <span class="button-span">
          {{ $t('follow') }}
        </span>
      </v-btn>

      <v-menu
        offset-y
        :close-on-click="closeOnClick"
      >
        <template v-slot:activator="{ on }">
          <v-btn v-on="on" icon>
            <v-icon>mdi-dots-horizontal</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item>
            <v-list-item-action>
              <v-icon> mdi-alert </v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                {{ $t('report') }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-card-title>

    <v-divider></v-divider>

    <v-card-text>
      <v-container>
        <v-row justify="space-between">
          <v-col cols="auto" class="profile-picture-container">
            <v-img
              height="200"
              width="200"
              :src="userCopy.avatar ? `/storage/${userCopy.avatar}` : '/images/site/default_avatar.jpg'"
            />
          </v-col>

          <v-col class="pa-0">
            <div class="card-content-container">
              <div class="card-content header">
                {{ $t('articles') }}
              </div>
              <div class="card-content sub-header">
                {{ userCopy.articles }}
              </div>
            </div>
          </v-col>

          <v-col class="pa-0">
            <div class="card-content-container">
              <div class="card-content header">
                {{ $t('followers') }}
              </div>
              <div class="card-content sub-header">
                {{ userCopy.followers }}
              </div>
            </div>
          </v-col>

          <v-col class="pa-0">
            <div class="card-content-container">
              <div class="card-content header">
                {{ $t('following') }}
              </div>
              <div class="card-content sub-header">
                {{ userCopy.following }}
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
import axios from 'axios'
import moment from 'moment'
import { mapGetters } from 'vuex'

export default {
  name: 'ProfileViewCard',
  props: {
    closeOnClick: true,
    user: {
      type: Object,
      required: true
    }
  },
  data:() => ({
    userCopy: null
  }),
  computed: {
    ...mapGetters({
      vxIsAuthUser: 'auth/check'
    })
  },
  created() {
    this.userCopy = this.user
  },
  methods: {
    joinedAt() {
      const joinedMoment = new moment(this.user.created_at).fromNow()
      return `${this.$t('joined')}: ${joinedMoment}`;
    },
    followUser() {
      if (!this.vxIsAuthUser) {
        this.$router.push("/register")
      } else {
        axios.post(`/api/profile/follow/${this.userCopy.username}`)
          .then((response) => {
            this.userCopy.is_followed = true
            console.log(response)
          })
          .catch((error) => {
            console.error(error)
          })
      }
    },
    unFollowUser() {
      if (!this.vxIsAuthUser) {
        this.$router.push("/register")
      } else {
        axios.delete(`/api/profile/follow/${this.userCopy.username}`)
          .then((response) => {
            this.userCopy.is_followed = false
            console.log(response)
          })
          .catch((error) => {
            console.error(error)
          })
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .profile-picture-container {
    background-color: #f1f2f3;
    border-radius: 5px;
  }
  .button-span {
    margin-left: 5px;
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
