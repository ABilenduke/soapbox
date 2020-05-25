<template>
  <v-container fluid>
      <v-row dense>
        <v-col
          v-for="card in cards"
          :key="card.key"
          :cols="card.flex"
        >
          <v-card>
            <v-img
              class="white--text align-end"
              :src="`/images/featured/${card.image}`"
              height="250px"
            />
            <v-card-title>
              {{ card.title }}
            </v-card-title>

            <v-card-subtitle>
              {{ card.author }}
            </v-card-subtitle>

            <v-card-text>
              {{ card.description }}
            </v-card-text>

            <v-card-actions>
              <v-btn text>Share</v-btn>

              <v-btn
                color="purple"
                text
              >
                Explore
              </v-btn>

              <v-spacer></v-spacer>

              <v-icon color="red">
                mdi-heart
              </v-icon>

              {{ card.likes }}

              <v-btn
                icon
                @click="card.bookmarked = !card.bookmarked"
              >
                <v-icon>
                  {{ card.bookmarked ? 'mdi-bookmark' : 'mdi-bookmark-outline' }}
                </v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
  </v-container>
</template>
<script>
  import helpers from '~/helpers';
  const { getRandomId } = helpers;

  export default {
    name: 'HomePage',
    data() {
      return {
        show: false,
        cards: null
      }
    },
    created() {
      this.cards = [
        {
          key: getRandomId('card'),
          flex: 6,
          image: 'business-1.jpg',
          author: 'Jimbo',
          title: 'Article 1',
          description: 'AWSOME STUFF!',
          likes: 3,
          bookmarked: false,
        },
        {
          key: getRandomId('card'),
          flex: 6,
          image: 'business-2.jpg',
          author: 'Jane Doe',
          title: 'Article 2',
          description: 'COOL STUFF!',
          likes: 3,
          bookmarked: false,
        },
        {
          key: getRandomId('card'),
          flex: 4,
          image: 'fitness-1.jpg',
          author: 'Sam',
          title: 'Article 3',
          description: 'So hot!!!',
          likes: 3,
          bookmarked: false,
        },
        {
          key: getRandomId('card'),
          flex: 4,
          image: 'fitness-2.jpg',
          author: 'Steve',
          title: 'Article 4',
          description: 'Get Ripped!',
          likes: 3,
          bookmarked: false,
        },
        {
          key: getRandomId('card'),
          flex: 4,
          image: 'food-1.jpg',
          author: 'Susan',
          title: 'Article 5',
          description: 'Eat the right stuff!',
          likes: 3,
          bookmarked: false,
        },
        {
          key: getRandomId('card'),
          flex: 6,
          image: 'business-2.jpg',
          author: 'Jane Doe',
          title: 'Article 2',
          description: 'COOL STUFF!',
          likes: 3,
          bookmarked: false,
        },
        {
          key: getRandomId('card'),
          flex: 6,
          image: 'business-1.jpg',
          author: 'Jane Doe',
          title: 'Article 2',
          description: 'COOL STUFF!',
          likes: 3,
          bookmarked: false,
        },
      ]
    }
  }
</script>