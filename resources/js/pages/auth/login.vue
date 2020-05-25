<template>
  <v-container fluid>
      <v-row dense>
        <v-col>
          <ValidationObserver
            ref="loginObserver"
            v-slot="{
              invalid
            }"
          >
            <form>
              <v-container>
                <v-sheet
                  class="pa-12"
                >
                  <v-row>
                    <v-col cols="12">
                      <h1>
                        {{ $t('login.title') }}
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
                        rules="required"
                      >
                        <v-text-field
                          v-model="form.password"
                          name="password"
                          :label="$t('password')"
                          :error-messages="errors"
                          type="password"
                          required
                        />
                      </ValidationProvider>
                    </v-col>

                    <v-col cols="12">
                      <v-checkbox
                        v-model="remember"
                        :label="$t('remember_me')"
                      />
                    </v-col>

                    <v-col cols="12">
                      <v-btn
                        color="success"
                        class="mr-4"
                        :disabled="invalid"
                        @click="login"
                      >
                        {{ $t('submit') }}
                      </v-btn>
                      <v-btn
                        color="error"
                        class="mr-4"
                        @click="resetForm"
                      >
                        {{ $t('reset') }}
                      </v-btn>
                    </v-col>

                    <v-col cols="12">
                      <router-link :to="{name: 'password.request'}">
                        {{ $t('login.resetPassword') }}
                      </router-link>
                    </v-col>
                  </v-row>

                  <v-row v-if="mustVerifyMessage">
                    <v-col cols="12">
                      <v-alert color="orange" v-html="mustVerifyMessage"></v-alert>
                    </v-col>
                  </v-row>
                </v-sheet>
              </v-container>
            </form>
          </ValidationObserver>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
import { ADD_MESSAGE } from '~/store/mutation-types'

export default {
  name: 'LoginPage',
  middleware: 'guest',
  metaInfo () {
    return { title: this.$t('login.title') }
  },
  data: () => ({
    form: {
      email: null,
      password: null,
    },
    remember: false,
    mustVerifyMessage: null
  }),
  methods: {
    async login() {
      await axios.post('/api/login', this.form)
        .then(async ({ data }) => {

          this.$store.dispatch('auth/saveToken', {
            token: data.token,
            remember: this.remember
          })

          this.$store.commit(`flash/${ ADD_MESSAGE }`, {
            level: 'success',
            body: this.$t('login.messages.success'),
            isAutoRemove: true
          })

          await this.$store.dispatch('auth/fetchUser')

          this.$router.push({ name: 'home' })
        })
        .catch(({ response }) => {
          const errors = response.data.errors

          if (errors.email) {
            this.mustVerifyMessage = errors.email[0]
          }

          this.$store.commit(`flash/${ ADD_MESSAGE }`, {
            level: 'danger',
            body: 'login.messages.failure',
            isAutoRemove: true
          })
        })
    },
    resetForm() {
      this.form.email = ''
      this.form.password = ''
      this.$refs.loginObserver.reset()
    },
  }
}
</script>