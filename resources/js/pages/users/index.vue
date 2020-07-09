<template>
  <InfiniteScroll
    :component="userCardComponent"
    structure="flat"
    title="users-page"
    endpoint="/api/users"
  />
</template>

<script>
import ProfileCard from "~/components/base/ProfileCard.vue";

export default {
  name: "UsersIndexPage",
  components: { ProfileCard },
  data: () => ({
    userCardComponent: ProfileCard
  }),
};
</script>
