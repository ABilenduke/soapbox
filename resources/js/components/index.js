import Vue from 'vue'
import ArticleCard from './base/ArticleCard.vue'
import Pagination from './base/Pagination.vue'
import Modal from './base/Modal.vue'
import ImageCropper from './base/ImageCropper.vue'
import UserViewCard from './page/profile/information/ViewCard.vue'

import { ValidationObserver, ValidationProvider } from 'vee-validate'

// Components that are registered globaly.
[
  {
    name: 'ArticleCard',
    comp: ArticleCard
  },
  {
    name: 'Pagination',
    comp: Pagination
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
