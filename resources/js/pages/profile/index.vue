<template>
  <v-container
    id="user-profile"
    fluid
    tag="section"
  >
    <v-app-bar
      color="blue"
      dense
    >
        <v-row>
          <v-col
            v-for="(item, index) in menuItems"
            :key="`profile-list-item-${index}`"
            class="menu-item"
          >
            <v-btn
              link
              :to="item.to"
              text
            >
              {{ item.name }}
            </v-btn>
          </v-col>
        </v-row>
    </v-app-bar>
    <v-row justify="center">
      <v-col cols="12">
        <transition name="fade" mode="out-in">
          <router-view />
        </transition>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'ProfilePage',
  data: () => ({
    menuItems: null
  }),
  computed: {
    ...mapGetters({
      vxUser: 'profile/user',
      vxUserIsAuth: 'profile/userIsAuth'
    }),
  },
  async created() {
    const username = this.$route.params.username
    await this.$store.dispatch('profile/fetchUser', username)

    this.menuItems = [
      {
        name: this.$t('profile.links.info'),
        to: `/profile/${username}/information`
      },
      {
        name: this.$t('profile.links.articles'),
        to: `/profile/${username}/articles`
      },
      {
        name: this.$t('profile.links.followers'),
        to: `/profile/${username}/followers`
      },
      {
        name: this.$t('profile.links.following'),
        to: `/profile/${username}/following`
      }
    ]

    if (this.vxUserIsAuth) {
      this.menuItems.push({
        name: this.$t('profile.links.settings'),
        to: `/profile/${username}/settings`
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.menu-item {
  text-align: center;
  cursor: pointer;
}
</style>