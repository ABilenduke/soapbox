<template>
  <v-container fluid>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>
            {{ $t('verification.title') }}
          </v-card-title>
          <template color="green" dark v-if="success">
            <v-card-text>
              <v-alert color="green" dark>
                {{ $t('verification.success') }}
              </v-alert>
            </v-card-text>

            <v-card-actions>
              <v-btn link :to="{ name: 'login' }">
                {{ $t('login.title') }}
              </v-btn>
            </v-card-actions>
          </template>
          <template v-else>
            <v-card-text>
              <v-alert color="red" dark>
                {{ error || $t('verification.failed') }}
              </v-alert>
            </v-card-text>

            <v-card-actions>
              <v-btn link :to="{ name: 'verification.resend' }">
                {{ $t('verification.resend') }}
              </v-btn>
            </v-card-actions>
          </template>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
const qs = (params) => Object.keys(params).map(key => `${key}=${params[key]}`).join('&')

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('verify_email') }
  },

  async beforeRouteEnter (to, from, next) {
    try {
      const { data } = await axios.post(`/api/email/verify/${to.params.username}?${qs(to.query)}`)
      next(vm => { vm.success = data.status })
    } catch (e) {
      next(vm => { vm.error = e.response.data.status })
    }
  },
  
  data: () => ({
    error: '',
    success: ''
  })
}
</script>