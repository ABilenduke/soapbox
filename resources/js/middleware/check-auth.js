import store from '~/store'

export default async (to, from, next) => {
  if (!store.getters['auth/check'] && store.getters['auth/token']) {
    try {
      await store.dispatch('auth/fetchUser')
    } catch (error) {
      // TODO: HANDLE ERROR, maybe login again?
    }
  }
  next()
}
