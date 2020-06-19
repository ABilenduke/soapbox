import Vue from 'vue'
import DarkModeSwitch from './base/DarkModeSwitch.vue'
import LocaleDropdown from './base/LocaleDropdown.vue'
import InfiniteScroll from './base/InfiniteScroll.vue'
import Modal from './base/Modal.vue'
import ImageCropper from './base/ImageCropper.vue'

import { ValidationObserver, ValidationProvider } from 'vee-validate'

// Components that are registered globaly.
[
  {
    name: 'DarkModeSwitch',
    comp: DarkModeSwitch
  },
  {
    name: 'LocaleDropdown',
    comp: LocaleDropdown
  },
  {
    name: 'InfiniteScroll',
    comp: InfiniteScroll
  },
  {
    name: 'Modal',
    comp: Modal
  },
  {
    name: 'ImageCropper',
    comp: ImageCropper
  },
  {
    name: 'ValidationObserver',
    comp: ValidationObserver
  },
  {
    name: 'ValidationProvider',
    comp: ValidationProvider
  },
].forEach(Component => {
  Vue.component(Component.name, Component.comp)
})
