<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-file-input
          :rules="rules"
          accept="image/png, image/jpeg, image/bmp"
          :placeholder="generatedPlaceholder"
          :label="generatedLabel"
          filled
          prepend-icon="mdi-camera"
          @change="setImage"
        />
      </v-col>
    </v-row>

    <Modal :modalIsOpen="modalIsOpen" @modalBackgroundClicked="modalIsOpen = false">
      <v-card>
        <v-card-title>
          <slot name="title-bar"></slot>
        </v-card-title>

        <v-card-text class="crop-body">
          <v-container class="py-0">
            <v-row v-if="imageUrl">
              <v-col cols="12">
                <VueCropper ref="cropper" :aspect-ratio="1 / 1" :src="imageUrl" alt="Source Image" />
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-card-actions v-if="imageUrl">
          <v-btn @click.prevent="zoom(0.2)">{{ $t('zoomIn') }}</v-btn>
          <v-spacer />
          <v-btn color="green" @click.prevent="cropImage">{{ $t('crop') }}</v-btn>
          <v-spacer />
          <v-btn @click.prevent="zoom(-0.2)">{{ $t('zoomOut') }}</v-btn>
        </v-card-actions>
      </v-card>
    </Modal>
  </v-container>
</template>

<script>
import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";

export default {
  components: { VueCropper },
  props: {
    placeholder: {
      type: String,
      required: false
    },
    label: {
      type: String,
      required: false
    }
  },
  data: () => ({
    modalIsOpen: false,
    imageUrl: null,
    rules: [
      value =>
        !value ||
        value.size < 2000000 ||
        "Avatar size should be less than 2 MB!"
    ]
  }),
  created() {
    this.generatedPlaceholder = this.placeholder ? this.placeholder : this.$t('selectImage')
    this.generatedLabel = this.label ? this.label : this.$t('image')
  },
  methods: {
    cropImage() {
      const imageCropped = this.$refs.cropper.getCroppedCanvas().toDataURL();
      this.$emit("imageCropped", imageCropped);
      this.imageUrl = null;
      this.modalIsOpen = false;
    },
    setImage(file) {
      if (file.type.indexOf("image/") === -1) {
        alert("Please select an image file");
        return;
      }

      if (typeof FileReader === "function") {
        const reader = new FileReader();
        reader.onload = event => {
          this.modalIsOpen = true;
          this.imageUrl = event.target.result;
          // rebuild cropperjs with the updated source
          if (this.$refs.cropper) {
            this.$refs.cropper.replace(event.target.result);
          }
        };
        reader.readAsDataURL(file);
      } else {
        alert("Sorry, FileReader API not supported");
      }
    },
    zoom(percent) {
      this.$refs.cropper.relativeZoom(percent);
    }
  }
};
</script>

<style lang="scss" scoped>
.crop-body {
  max-height: 75%;
}
</style>