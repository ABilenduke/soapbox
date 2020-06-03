<template>
  <v-list dense>
    <v-list-item
      v-for="item in items"
      :key="item.text"
      link
      :to="{ name: `${ item.to }` }"
    >
      <v-list-item-action>
        <v-icon>{{ item.icon }}</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>
          {{ $t(item.text) }}
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-subheader class="mt-4 grey--text text--darken-1">
      {{ $t('top_contributors') }}
    </v-subheader>
    <v-list>
      <v-list-item
        v-for="(item, index) in items2"
        :key="item.text"
        link
      >
        <v-badge
          :color="rank[index].color"
          :icon="rank[index].icon"
          overlap
          dark
          offset-x="30"
          offset-y="20"
        >
          <v-list-item-avatar>
            <v-img
              :src="`https://randomuser.me/api/portraits/men/${item.picture}.jpg`"
              alt=""
            />
          </v-list-item-avatar>
        </v-badge>
        <v-list-item-title v-text="item.text" />
      </v-list-item>
    </v-list>
    <v-list-item
      class="mt-4"
      link
    >
      <v-list-item-action>
        <v-icon color="grey darken-1">mdi-plus-circle-outline</v-icon>
      </v-list-item-action>
      <v-list-item-title class="grey--text text--darken-1">Browse Channels</v-list-item-title>
    </v-list-item>
    <v-list-item link>
      <v-list-item-action>
        <v-icon color="grey darken-1">mdi-settings</v-icon>
      </v-list-item-action>
      <v-list-item-title class="grey--text text--darken-1">Manage Subscriptions</v-list-item-title>
    </v-list-item>
  </v-list>
</template>

<script>
export default {
  name: 'MenuContent',
  data: () => ({
    items: null,
    items2: [
      { picture: 28, text: 'Joseph' },
      { picture: 38, text: 'Apple' },
      { picture: 48, text: 'Xbox Ahoy' },
      { picture: 58, text: 'Nokia' },
      { picture: 78, text: 'MKBHD' },
    ],
    rank: [
      {
        color: 'yellow',
        icon: 'mdi-star-face'
      },
      {
        color: 'red',
        icon: 'mdi-lock'
      },
      {
        color: 'red',
        icon: 'mdi-lock'
      },
      {
        color: 'red',
        icon: 'mdi-lock'
      },
      {
        color: 'red',
        icon: 'mdi-lock'
      }
    ]
  }),
  created() {
    this.items = [
      { icon: 'mdi-home', text: 'home', to: 'home' },
      { icon: 'mdi-account-group', text: 'users', to: 'users' },
      { icon: 'mdi-account-star', text: 'subscriptions', to: 'subscriptions' },
      { icon: 'mdi-history', text: 'history', to: 'articles.history' },
      { icon: 'mdi-bookmark', text: 'saved', to: 'articles.saved' },
      { icon: 'mdi-pencil', text: 'create.title', to: 'articles.create.index' },
    ]
  }
}
</script>
