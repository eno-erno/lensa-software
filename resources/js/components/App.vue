<template>
  <Layout>
    <template #default>
      <router-view></router-view> 
    </template>
  </Layout>
</template>

<script>
import Layout from '@/layouts/Layout.vue';

export default {
  components: {
    Layout
  }
};
</script>
