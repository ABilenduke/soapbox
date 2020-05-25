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
                          {{ $t('resetPassword.title') }}
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
                      <ValidationProvider
                        v-slot="{ errors }"
                        name="password"
                        rules="required|max:255|confirmed:confirmation"
                      >
                        <v-text-field
                          v-model="form.password"
                          :label="$t('password')"
                          :error-messages="errors"
                          type="password"
                          required
                        />
                      </ValidationProvider>
                    </v-col>

                    <v-col cols="12">
                      <ValidationProvider
                        v-slot="{ errors }"
                        name="password_confirmation"
                        rules="required|max:255"
                        vid="confirmation"
                      >
                        <v-text-field
                          v-model="form.password_confirmation"
                          :label="$t('password_confirmation')"
                          :error-messages="errors"
                          type="password"
                          required
                        />
                      </ValidationProvider>
                    </v-col>

                      <v-col cols="12">
                        <v-btn
                          color="success"
                          class="mr-4"
                          :disabled="invalid"
                          @click="resetEmail"
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
    return { title: this.$t('resetPassword.title') }
  },
  data: () => ({
    status: {
      message: null,
      colour: null
    },
    form: {
      email: '',
      password: '',
      password_confirmation: '',
      token: ''
    }
  }),
  created () {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },
  methods: {
    async resetEmail () {
      await axios.post('/api/password/reset', this.form)
        .then(({ data }) => {
          this.status.message = data.status
          this.status.colour = 'green'
        })
        .catch(({ response }) => {
          const errors = response.data.errors
          let errorMessage = this.$t('resetPassword.error')

          this.status.message = errors
          this.status.colour = 'red'
        })
    }
  }
}
</script>