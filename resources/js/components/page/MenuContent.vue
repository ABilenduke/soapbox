<template>
  <v-list dense>
    <v-list-item v-for="item in items" :key="item.text" link :to="{ name: `${ item.to }` }">
      <v-list-item-action>
        <v-icon>{{ item.icon }}</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>{{ $t(item.text) }}</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-subheader class="mt-4 grey--text text--darken-1">{{ $t('top_contributors') }}</v-subheader>
    <v-list v-if="topContributors">
      <v-list-item
        v-for="(user, index) in topContributors"
        :key="user.username"
        :to="`/profile/${user.username}`"
        link
        class="pa-0"
      >
        <v-badge
          :icon="`mdi-numeric-${index + 1}`"
          color="accent"
          overlap
          dark
          offset-x="30"
          offset-y="20"
        >
          <v-list-item-avatar>
            <v-img :src="user.avatar" :alt="`${user.username}'s avatar`" />
          </v-list-item-avatar>
        </v-badge>

        <v-list-item-content>
          <v-list-item-title v-text="user.username" />
          <v-list-item-subtitle v-text="user.reputation" class="pl-1"></v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <v-spacer />

    <v-list-item>
      <v-select :items="locales" :label="$t('locale')" flat dense solo />
    </v-list-item>
    <v-list-item class="mt-1">
      <v-list-item-action>
        <v-switch v-model="darkMode" class="mx-2"></v-switch>
      </v-list-item-action>
      <v-list-item-title class="grey--text text--darken-1">{{ $t('darkMode') }}</v-list-item-title>
    </v-list-item>
  </v-list>
</template>

<script>
import axios from "axios";
import { mapGetters, mapActions } from 'vuex'

export default {
  name: "MenuContent",
  data: () => ({
    items: null,
    topContributors: null,
    locales: ["en", "fr"],
    darkMode: false
  }),
  computed: {
    ...mapGetters({
      vxSettings: 'auth/settings'
    }),
  },
  watch: {
    darkMode(newValue) {
      this.$vuetify.theme.dark = newValue
      if (this.vxSettings) {
        this.vxToggleDarkMode(newValue)
      }
    }
  },
  async created() {
    await axios
      .get("/api/topcontributors")
      .then(({ data }) => (this.topContributors = data.top_contributors))
      .catch(error => {
        console.error({ error });
      });
    this.items = [
      { icon: "mdi-home", text: "home", to: "home" },
      { icon: "mdi-account-group", text: "users", to: "users" },
      { icon: "mdi-history", text: "history", to: "articles.history" },
      { icon: "mdi-bookmark", text: "saved", to: "articles.saved" },
      { icon: "mdi-pencil", text: "create.title", to: "articles.create.index" }
    ];
    if (this.vxSettings) {
      this.darkMode = this.vxSettings.dark_mode
    }
  },
  methods: {
    ...mapActions({
      vxToggleDarkMode: 'auth/toggleDarkMode'
    })
  }
};
</script>
