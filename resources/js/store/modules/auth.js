import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = () => ({
  user: null,
  token: Cookies.get('token')
})

// getters
export const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null
}

// mutations
export const mutations = {
  [types.SAVE_TOKEN] (state, { token, remember }) {
    state.token = token
    Cookies.set('token', token, { expires: remember ? 365 : null })
  },

  [types.FETCH_USER_SUCCESS] (state, { user }) {
    state.user = user
  },

  [types.FETCH_USER_FAILURE] (state) {
    state.token = null
    Cookies.remove('token')
  },

  [types.LOGOUT] (state) {
    state.user = null
    state.token = null

    Cookies.remove('token')
  },

  [types.UPDATE_USER] (state, { user }) {
    state.user = user
  },

  [types.UPDATE_USER_AVATAR] (state, path) {
    state.user.avatar = path
  }
}

// actions
export const actions = {
  saveToken ({ commit, dispatch }, payload) {
    commit(types.SAVE_TOKEN, payload)
  },

  fetchUser ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('/api/user')
      .then(({ data }) => {
        commit(types.FETCH_USER_SUCCESS, { user: data })
        resolve()
      })
      .catch(( error ) => {
        commit(types.FETCH_USER_FAILURE)
        reject(error)
      })
    })
  },

  updateUser ({ commit }, payload) {
    commit(types.UPDATE_USER, payload)
  },

  logout ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post('/api/logout')
      .then(() => {
        commit(types.LOGOUT)
        resolve()
      })
      .catch(( error ) => {
        reject(error)
      })
    })
  },

  async fetchOauthUrl (ctx, { provider }) {
    const { data } = await axios.post(`/api/oauth/${provider}`)

    return data.url
  },

  registerUser({ commit }, { registerForm }) {
    return new Promise((resolve, reject) => {
      axios.post('/api/register', registerForm)
      .then(({ data }) => {
        resolve(data)
      })
      .catch(( error ) => {
        reject(error)
      })
    })
  },

  editUser({ commit }, { editForm }) {
    return new Promise((resolve, reject) => {
      axios.patch('/api/user', editForm)
      .then(({ data }) => {
        resolve(data)
      })
      .catch(( error ) => {
        reject(error)
      })
    })
  },

  usernameIsUnique({ commit }, { username }) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/auth/check/username/${username}`)
      .then(({ data }) => {
        if (data.exists) {
          commit(`flash/${ types.ADD_MESSAGE }`, {
            level: 'warning',
            body: 'This username is already taken',
            isAutoRemove: true
          }, { root: true })
          reject()
        }
        resolve()
      })
      .catch(() => {
        resolve()
      })
    })
  },

  emailIsUnique({ commit }, { email }) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/auth/check/email/${email}`)
      .then(({ data }) => {
        if (data.exists) {
          commit(`flash/${ types.ADD_MESSAGE }`, {
            level: 'warning',
            body: 'This email is already taken',
            isAutoRemove: true
          }, { root: true })
          reject()
        }
        resolve()
      })
      .catch(() => {
        resolve()
      })
    })
  },

  uploadAvatar({ commit }, image) {
    return new Promise((resolve, reject) => {
      axios.post('/api/profile/avatar', {
        avatar: image
      })
      .then(({ data }) => {
        commit(`flash/${ types.ADD_MESSAGE }`, {
          level: 'success',
          body: 'Avatar uploaded successfully.',
          isAutoRemove: true
        }, { root: true })
        commit(types.UPDATE_USER_AVATAR, data.path)
        resolve()
      })
      .catch(() => {
        resolve()
      })
    })
  }
}