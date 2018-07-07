<template>
  <div class="form-header">
      <div class="form-header__icon-container" @click="back">
        <font-awesome-icon 
            class="form-header__icon" 
            :icon="faIcon">
        </font-awesome-icon>
      </div>
      <div class="form-header__title-container">
        <h3 class="form-header__title">
            {{ title }}
        </h3>
      </div>
  </div>
</template>

<script>
import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import faArrowLeft from '@fortawesome/fontawesome-free-solid/faArrowLeft';

export default {

  components: {
    FontAwesomeIcon
  },

  props: {
    title: String
  },

  methods: {

    back: function() {
      this.$router.go(-1)
    }

  },

  computed: {

    faIcon: function() {
      return faArrowLeft
    }

  }

}
</script>

<style lang="scss">

.form-header {

  $fh-offset: 40px;

  display: flex;
  align-items: center;
  margin-bottom: 0.5rem;

  &__icon-container {
    height: $fh-offset!important;
    width: $fh-offset!important;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }

  &__icon {
    height: 20px;
    width: 20px!important;
  }

  &__title-container {
    text-align: center;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  &__title {
    margin-bottom: 0;
    margin-left: -$fh-offset;
  }

}

</style>