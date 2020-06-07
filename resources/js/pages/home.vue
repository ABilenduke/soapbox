<template>
  <v-container fluid>
      <v-row dense>
        <v-col
          v-for="article in articles"
          :key="article.key"
          :lg="article.flex"
          :sm="12"
        >
          <ArticleCard :article="article" />
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
        articles: null
      }
    },
    created() {
      this.articles = [
        {
          key: getRandomId('card'),
          flex: 6,
          coverImage: 'business-1.jpg',
          author: 'Jimbo',
          title: 'Article 1',
          description: 'AWSOME STUFF!',
          likes: 3,
          bookmarked: false,
          liked: false,
        },
        {
          key: getRandomId('card'),
          flex: 6,
          coverImage: 'business-2.jpg',
          author: 'Jane Doe',
          title: 'Article 2',
          description: 'COOL STUFF!',
          likes: 3,
          bookmarked: false,
          liked: false,
        },
        {
          key: getRandomId('card'),
          flex: 4,
          coverImage: 'fitness-1.jpg',
          author: 'Sam',
          title: 'Article 3',
          description: 'So hot!!!',
          likes: 3,
          bookmarked: false,
          liked: false,
        },
        {
          key: getRandomId('card'),
          flex: 4,
          coverImage: 'fitness-2.jpg',
          author: 'Steve',
          title: 'Article 4',
          description: 'Get Ripped!',
          likes: 3,
          bookmarked: false,
          liked: false,
        },
        {
          key: getRandomId('card'),
          flex: 4,
          coverImage: 'food-1.jpg',
          author: 'Susan',
          title: 'Article 5',
          description: 'Eat the right stuff!',
          likes: 3,
          bookmarked: false,
          liked: false,
        },
        {
          key: getRandomId('card'),
          flex: 6,
          coverImage: 'business-2.jpg',
          author: 'Jane Doe',
          title: 'Article 2',
          description: 'COOL STUFF!',
          likes: 3,
          bookmarked: false,
          liked: false,
        },
        {
          key: getRandomId('card'),
          flex: 6,
          coverImage: 'business-1.jpg',
          author: 'Jane Doe',
          title: 'Article 2',
          description: 'COOL STUFF!',
          likes: 3,
          bookmarked: false,
          liked: false,
        },
      ]
    }
  }
</script>