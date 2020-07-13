<template>
  <v-list-item>
    <v-select
      :items="locales"
      :label="$t('locale')"
      flat
      dense
      solo
      @input="setLocale"
    />
  </v-list-item>
</template>

<script>
import { mapGetters } from "vuex";
import { loadMessages } from "~/plugins/i18n";

export default {
  name: "LocaleDropdown",
  computed: mapGetters({
    locale: "lang/locale",
    locales: "lang/locales"
  }),
  methods: {
    setLocale(locale) {
      locale = locale.toLowerCase()
      
      if (this.$i18n.locale !== locale) {
        loadMessages(locale);
        this.$store.dispatch("lang/setLocale", { locale });
      }
    }
  }
};
</script>