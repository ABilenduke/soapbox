<template>
  <v-container v-if="vxUser" class="py-0">
    <v-row>
      <v-col class="pa-0">
        <v-btn v-if="vxUserIsAuth" @click="toggleEditing()">
          {{ $t('edit') }}
        </v-btn>
        <component :is="selectedComponent" :user="vxUser" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters } from 'vuex'
import EditCard from '~/components/page/profile/information/EditCard.vue'
import ViewCard from '~/components/page/profile/information/ViewCard.vue'

export default {
  name: 'ProfileInfo',
  components: { EditCard, ViewCard },
  data: () => ({
    user: null,
    selectedComponent: 'ViewCard',
    isEditing: false
  }),
  computed: {
    ...mapGetters({
      vxUser: 'profile/user',
      vxUserIsAuth: 'profile/userIsAuth'
    }),
  },
  methods: {
    toggleEditing() {
      this.isEditing = !this.isEditing
      if (this.selectedComponent === 'ViewCard') {
          this.selectedComponent = 'EditCard'
      } else {
          this.selectedComponent = 'ViewCard'
      }
    }
  }
}
</script>
