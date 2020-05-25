import store from '~/store'
import { required, confirmed, email, max } from 'vee-validate/dist/rules'
import { extend } from 'vee-validate'

extend('required', {
  ...required,
  message: '{_field_} can not be empty',
})

extend('confirmed', {
  ...confirmed,
  message: '{_field_} needs to be confirmed',
})

extend('max', {
  ...max,
  message: '{_field_} may not be greater than {length} characters',
})

extend('email', {
  ...email,
  message: 'Email must be valid',
})

extend('uniqueUsername', {
  validate: async (value) => {
    const response = await store.dispatch('auth/usernameIsUnique', { username: value })
      .then(() => {
        return true;
      })
      .catch(() => {
        return false;
      })

    return response
  },
  message: "This username has been taken."
});

extend('uniqueEmail', {
  validate: async (value) => {
    const response = await store.dispatch('auth/emailIsUnique', { email: value })
      .then(() => {
        return true;
      })
      .catch(() => {
        return false;
      })
    return response
  },
  message: "This email has been taken."
});
