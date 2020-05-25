import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = () => ({
  user: null,
  isUserAuth: false
})

// getters
export const getters = {
  user: state => state.user,
  check: state => state.user !== null,
  userIsAuth: state => state.isUserAuth
}

// mutations
export const mutations = {
  [types.FETCH_PROFILE_USER_SUCCESS] (state, { user }) {
    state.user = user
  },

  [types.IS_USER_AUTH] (state, { isUserAuth }) {
    state.isUserAuth = isUserAuth
  },
}

// actions
export const actions = {
  async fetchUser ({ state, commit, rootState }, username) {
    if (!!rootState.auth.user && rootState.auth.user.username === username) {
      commit(types.IS_USER_AUTH, { isUserAuth: true })
      commit(types.FETCH_PROFILE_USER_SUCCESS, { user: rootState.auth.user })
    } else {
      commit(types.IS_USER_AUTH, { isUserAuth: false })
      await axios.get(`/api/profile/user/${username}`)
      .then(({ data }) => {
        commit(types.FETCH_PROFILE_USER_SUCCESS, { user: data.user })
      })
      .catch(( error ) => {
        console.error({ error })
      })
    }
  },
}
