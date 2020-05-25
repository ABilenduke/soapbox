<template>
  <Modal
    :modalIsOpen="modalIsOpen"
    @modalBackgroundClicked="$emit('modalBackgroundClicked')"
  >
    <v-card>
      <v-card-title>
        <slot name="title-bar"></slot>
      </v-card-title>

      <v-card-text class="crop-body">
        <v-container class="py-0">
          <v-row>
            <v-col cols="12">
              <v-file-input
                :rules="rules"
                accept="image/png, image/jpeg, image/bmp"
                placeholder="Pick an avatar"
                prepend-icon="mdi-camera"
                label="Avatar"
                @change="setImage"
              />
            </v-col>
          </v-row>

          <v-row v-if="imageUrl">
            <v-col cols="12">
              <VueCropper
                ref="cropper"
                :aspect-ratio="1 / 1"
                :src="imageUrl"
                alt="Source Image"
              />
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>

      <v-card-actions v-if="imageUrl">
        <v-btn
          @click.prevent="zoom(0.2)"
        >
          Zoom In
        </v-btn>
        <v-btn
          @click.prevent="zoom(-0.2)"
        >
          Zoom Out
        </v-btn>
        <v-btn
          @click.prevent="cropImage"
        >
          Upload
        </v-btn>
      </v-card-actions>
    </v-card>
  </Modal>
</template>

<script>
import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';

export default {
  components: { VueCropper },
  props: {
    modalIsOpen: {
      type: Boolean
    }
  },
  data: () => ({
    imageUrl: null,
    rules: [
      value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
    ],
  }),
  methods: {
    cropImage() {
      const imageCropped = this.$refs.cropper.getCroppedCanvas().toDataURL()
      this.$emit('imageCropped', imageCropped)
      this.imageUrl = null
    },
    setImage(file) {
      if (file.type.indexOf('image/') === -1) {
        alert('Please select an image file');
        return;
      }
      if (typeof FileReader === 'function') {
        const reader = new FileReader();
        reader.onload = (event) => {
          this.imageUrl = event.target.result;
          // rebuild cropperjs with the updated source
          if (this.$refs.cropper) {
            this.$refs.cropper.replace(event.target.result);
          }
        };
        reader.readAsDataURL(file);
      } else {
        alert('Sorry, FileReader API not supported');
      }
    },
    zoom(percent) {
      this.$refs.cropper.relativeZoom(percent);
    },
  },
}
</script>

<style lang="scss" scoped>
.crop-body {
  max-height: 75%;
}
</style>