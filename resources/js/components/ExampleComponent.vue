<template>
  <div class="card">
    <button type="button" @click="getLocation" class="btn btn-secondary" id="demo">Fetch Location</button>
    <div class="card-body" id="coordinates">{{ latitude }}, {{ longitude }}</div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      latitude: null,
      longitude: null
    }
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this.onSuccess);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    },
    onSuccess(position) {
      this.latitude = position.coords.latitude;
      this.longitude = position.coords.longitude;
    }
  }
};
</script>
