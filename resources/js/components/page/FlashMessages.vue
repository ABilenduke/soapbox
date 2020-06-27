<template>
  <div v-if="vxFlashMessages" class="flash-container">
    <v-alert
      v-for="message in vxFlashMessages"
      :key="message.key"
      v-model="message.alert"
      :color="message.colour"
      :icon="message.icon"
      dark
      dismissible
    >
      {{ $t(message.body) }}
    </v-alert>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
import { REMOVE_MESSAGE } from '~/store/mutation-types'

export default {
  name: 'FlashMessages',
  data() {
    return {
      max: 20
    }
  },
  computed: {
    ...mapGetters({
      vxFlashMessages: 'flash/messages'
    })
  },
  watch: {
    vxFlashMessages(newValue) {
      newValue.forEach((message) => {
        if (message.isAutoRemove) {
          this.autoRemove(message)
        }
      })
    }
  },
  methods: {
    ...mapMutations({
      vxRemoveFlashMessage: `flash/${ REMOVE_MESSAGE }`
    }),
    autoRemove(message) {
      setTimeout(() => {
        this.vxRemoveFlashMessage(message)
      }, 5000)
    },
  }
}
</script>

<style lang="scss" scoped>
.flash-container {
  position: fixed;
  bottom: 0;
  right: 0;
  padding: 5px;
  z-index: 1000;
}
</style>
