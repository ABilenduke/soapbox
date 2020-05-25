<template>
  <v-container fluid>
      <v-row dense>
        <v-col>
          <v-card>
            <ValidationObserver
              ref="registerObserver"
              v-slot="{ invalid }"
            >
              <form>
                <v-container>
                  <v-sheet
                    class="pa-12"
                  >
                    <v-row>
                      <v-col cols="12">
                        <h1>
                          {{ $t('emailPassword.title') }}
                        </h1>
                      </v-col>
                    </v-row>

                    <v-row>
                      <v-col cols="12">
                        <ValidationProvider
                          v-slot="{ errors }"
                          name="email"
                          rules="required|email"
                        >
                          <v-text-field
                            v-model="form.email"
                            name="email"
                            :label="$t('email')"
                            :error-messages="errors"
                            type="email"
                            required
                          />
                        </ValidationProvider>
                      </v-col>

                      <v-col cols="12">
                        <v-btn
                          color="success"
                          class="mr-4"
                          :disabled="invalid"
                          @click="sendEmail"
                        >
                          {{ $t('submit') }}
                        </v-btn>
                      </v-col>
                    </v-row>

                    <v-row v-if="status">
                      <v-col cols="12">
                        <v-alert :color="status.colour">
                          {{ status.message }}
                        </v-alert>
                      </v-col>
                    </v-row>
                  </v-sheet>
                </v-container>
              </form>
            </ValidationObserver>
          </v-card>
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'

export default {
  middleware: 'guest',
  metaInfo () {
    return { title: this.$t('emailPassword.title') }
  },
  data: () => ({
    status: {
      message: null,
      colour: null
    },
    form: {
      email: ''
    }
  }),
  created () {
    if (this.$route.query.email) {
      this.form.email = this.$route.query.email
    }
  },
  methods: {
    async sendEmail () {
      await axios.post('/api/password/email', this.form)
        .then(({ data }) => {
          this.status.message = data.status
          this.status.colour = 'green'
        })
        .catch(({ response }) => {
          let errorMessage = this.$t('resend.error')

          if (response?.data?.email) {
            errorMessage = response?.data?.email
          }
          this.status.message = errorMessage
          this.status.colour = 'red'
        })
    }
  }
}
</script>