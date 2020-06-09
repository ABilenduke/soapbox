import Vue from 'vue'
import InfiniteScroll from './base/InfiniteScroll.vue'
import Modal from './base/Modal.vue'
import ImageCropper from './base/ImageCropper.vue'
import UserViewCard from './page/profile/information/ViewCard.vue'

import { ValidationObserver, ValidationProvider } from 'vee-validate'

// Components that are registered globaly.
[
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
    name: 'UserViewCard',
    comp: UserViewCard
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
