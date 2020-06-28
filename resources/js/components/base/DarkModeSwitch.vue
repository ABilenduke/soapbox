<template>
  <v-list-item class="mt-1">
    <v-list-item-action>
      <v-switch v-model="darkMode" class="mx-2"></v-switch>
    </v-list-item-action>
    <v-list-item-title class="grey--text text--darken-1">{{ $t('darkMode') }}</v-list-item-title>
  </v-list-item>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "DarkModeSwitch",
  data: () => ({
    darkMode: false
  }),
  computed: {
    ...mapGetters({
      vxDarkMode: "auth/darkMode"
    })
  },
  watch: {
    darkMode(newValue) {
      this.$vuetify.theme.dark = newValue
      this.vxToggleDarkMode(newValue)
    }
  },
  created() {
    if (this.vxDarkMode) {
      this.darkMode = this.vxDarkMode
    }
  },
  methods: {
    ...mapActions({
      vxToggleDarkMode: "auth/toggleDarkMode"
    })
  }
};
</script>