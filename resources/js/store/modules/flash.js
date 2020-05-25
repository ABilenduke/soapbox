import * as types from '../mutation-types'
import helpers from '~/helpers';
const { getRandomId } = helpers;

const MESSAGE_ICONS = {
  'success': 'mdi-checkbox-marked-outline',
  'warning': 'mdi-do-not-disturb',
  'danger': 'mdi-close-circle-outline',
}

const MESSAGE_COLOURS = {
  'success': 'green',
  'warning': 'orange',
  'danger': 'red',
}

// state
export const state = () => ({
  messages: []
})

// getters
export const getters = {
  messages: state => state.messages,
  check: state => state.messages.length > 0
}

// mutations
export const mutations = {
  [types.ADD_MESSAGE] (state, message) {
    state.messages.push({
      key: getRandomId('flash-message'),
      alert: true,
      level: message.level,
      body: message.body,
      icon: MESSAGE_ICONS[message.level],
      colour: MESSAGE_COLOURS[message.level],
      isAutoRemove: message.isAutoRemove
    })
  },

  [types.REMOVE_MESSAGE] (state, message) {
    const index = state.messages.indexOf(message)

    if (index > -1) {
      state.messages[index].alert = false;

      setTimeout(() => {
        state.messages.splice(index, 1)
      }, 500)
    }
  },
}