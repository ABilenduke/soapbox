<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app clipped>
      <MenuContent />
    </v-navigation-drawer>

    <v-app-bar app color="primary" clipped-left dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />

      <v-toolbar-title class="mr-12 align-center">
        <v-img src="/images/site/logo.png" :height="45" alt="site logo" contain />
      </v-toolbar-title>

      <v-spacer />

      <v-menu v-if="vxUser" offset-y :close-on-click="closeOnClick">
        <template v-slot:activator="{ on }">
          <div v-on="on">
            <v-avatar class="profile-picture-container" tile>
              <v-img :height="45" :width="45" :src="vxUser.avatar" alt="user-avatar" />
            </v-avatar>
            {{ vxUser.username }}
          </div>
        </template>
        <v-list v-if="userMenuItems">
          <v-list-item v-for="item in userMenuItems" :key="item.text" link :to="item.to">
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ item.text }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link @click="logout()">
            <v-list-item-action>
              <v-icon>mdi-exit-to-app</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ $t('logout') }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>

      <template v-else>
        <v-btn color="green" link :to="{ name: 'register' }">{{ $t('register.title') }}</v-btn>
        <v-btn link :to="{ name: 'login' }" class="ml-1" text>{{ $t('login.title') }}</v-btn>
      </template>
    </v-app-bar>

    <v-content>
      <router-view></router-view>
    </v-content>

    <FlashMessages />
  </v-app>
</template>

<script>
import { mapGetters } from "vuex";
import MenuContent from "../components/page/MenuContent.vue";
import FlashMessages from "../components/page/FlashMessages.vue";
import { ADD_MESSAGE } from "~/store/mutation-types";

export default {
  components: { MenuContent, FlashMessages },
  props: {
    source: String
  },
  data: () => ({
    drawer: null,
    items: null,
    closeOnClick: true
  }),
  computed: {
    ...mapGetters({
      vxUser: "auth/user"
    }),
    userMenuItems() {
      if (this.vxUser) {
        return [
          {
            icon: "mdi-account-box",
            text: this.$t("profile.title"),
            to: `/profile/${this.vxUser.username}`
          },
          {
            icon: "mdi-cog",
            text: this.$t("settings"),
            to: "/profile/settings"
          }
        ];
      }
      return [];
    }
  },
  methods: {
    async logout() {
      await this.$store.dispatch("auth/logout");

      this.$store.commit(`flash/${ADD_MESSAGE}`, {
        level: "success",
        body: "Logged out successfully",
        isAutoRemove: true
      });

      this.$router.push({ name: "login" });
    }
  }
};
</script>

<style lang="scss" scoped>
.profile-picture-container {
  cursor: pointer;

  img {
    border-radius: 5px;
  }
}

span.title {
  visibility: hidden;
  opacity: 0;
  display: none;

  @media (min-width: 576px) {
    visibility: visible;
    opacity: 1;
    display: block;
  }
}
</style>
