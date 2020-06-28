<template>
  <v-container
    id="user-profile"
    fluid
    tag="section"
  >
    <v-app-bar
      color="primary"
      dense
      dark
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
              <v-icon>
                {{ item.icon }}
              </v-icon>
              <span class="menu-item-text">
                {{ item.name }}
              </span>
            </v-btn>
          </v-col>
        </v-row>
    </v-app-bar>
    <v-row justify="center" class="pa-0">
      <v-col cols="12" class="pa-0">
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
        icon: 'mdi-information-outline',
        to: `/profile/${username}/information`
      },
      {
        name: this.$t('profile.links.articles'),
        icon: 'mdi-book-open-variant',
        to: `/profile/${username}/articles`
      },
      {
        name: this.$t('profile.links.followers'),
        icon: 'mdi-account-multiple',
        to: `/profile/${username}/followers`
      },
      {
        name: this.$t('profile.links.following'),
        icon: 'mdi-account-multiple-outline',
        to: `/profile/${username}/following`
      }
    ]

    if (this.vxUserIsAuth) {
      this.menuItems.push({
        name: this.$t('profile.links.settings'),
        icon: 'mdi-cog-outline',
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

.menu-item-text {
  visibility: hidden;
  opacity: 0;
  display: none;

  @media (min-width: 768px) {
    visibility: visible;
    opacity: 1;
    display: block;
  }
}
</style>