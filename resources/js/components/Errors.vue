<template>
    <ul v-if="errors" class="mb-0 pl-3">
      <li v-for="error in errors" :key="error">{{ error }}</li>
    </ul>
</template>
<script>
export default {
    props: ['errors']
}
</script>