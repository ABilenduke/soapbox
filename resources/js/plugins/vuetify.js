import Vue from "vue";
import Vuetify from "vuetify";

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
    dark: false,
    themes: {
      light: {
        primary: '#5680E9',
        secondary: '#5AB9EA',
        anchor: '#8860D0',
      },
      dark: {
        primary: '#5680E9',
        secondary: '#5AB9EA',
        anchor: '#8860D0',
      },
    },
  },
  icons: {
    iconfont: "mdi"
  }
});
