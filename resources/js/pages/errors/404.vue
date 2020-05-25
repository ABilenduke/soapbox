<template>
  <v-card>
    <v-card-title>
      <h3 class="ma-4">
        {{ $t('page_not_found') }}
      </h3>
      <v-spacer />
      <v-btn
        link
        :to="{ name: 'home' }"
      >
        {{ $t('home') }}
      </v-btn>
    </v-card-title>

    <v-card-text>
      <v-img
        src="/images/site/page_not_found.svg"
        contain
        height="550"
      />
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>