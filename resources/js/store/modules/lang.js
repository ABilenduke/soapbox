import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

const { locale, locales } = window.config

// state
export const state = () => ({
  locale: Cookies.get('locale') || locale,
  locales: Object.values(locales)
})

// getters
export const getters = {
  locale: state => state.locale,
  locales: state => state.locales
}

// mutations
export const mutations = {
  [types.SET_LOCALE] (state, { locale }) {
    state.locale = locale
  }
}

// actions
export const actions = {
  setLocale ({ commit, rootGetters }, { locale }) {
    return new Promise((resolve, reject) => {
      commit(types.SET_LOCALE, { locale })
      Cookies.set('locale', locale, { expires: 365 })

      if (rootGetters["auth/check"]) {
        axios.put('/api/user/settings', {
          locale: locale
        })
        .then(({ data }) => {
          resolve()
        })
        .catch(() => {
          reject()
        })
      }
      
      resolve()
    })
  }
}
