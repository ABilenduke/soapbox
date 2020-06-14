<template>
  <v-container fluid v-if="paginatedUsers">
    <v-row dense>
        <v-col
          v-for="(user, index) in paginatedUsers.data"
          :key="`user-${index}`"
          :lg="3"
          :md="6"
          :sm="12"
        >
          <ProfileCard :user="user" />
        </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ProfileCard from '~/components/base/ProfileCard.vue'
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  name: 'UsersIndexPage',
  components: { ProfileCard },
  data: () => ({
    paginatedUsers: null,
    isLoading: false
  }),
  async created() {
    await this.getResults()
  },
  methods: {
    getResults(page = 1) {
      this.isLoading = true
      axios.get('/api/users?page=' + page)
          .then(({ data }) => this.paginatedUsers = data.users)
          .finally(() => this.isLoading = false);
    }
  }
}
</script>

<style lang="scss" scoped>
.profile-picture-container {
  background-color: #f1f2f3;
  border-radius: 5px;
}
</style>
