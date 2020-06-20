<template>
  <InfiniteScroll @hitTheBottom="$emit('hitTheBottom')">
    <v-col v-for="(user, index) in users" :key="`user-${index}`" :lg="3" :md="6" :sm="12">
      <ProfileCard :user="user" />
    </v-col>
  </InfiniteScroll>
</template>

<script>
import ProfileCard from "~/components/base/ProfileCard.vue";

export default {
  name: "UserInfiniteScroll",
  components: { ProfileCard },
  props: {
    users: {
      type: Array,
      default: []
    }
  }
};
</script>