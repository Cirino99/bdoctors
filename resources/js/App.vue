<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
    name: 'App'
}
</script>

<style lang="scss">
    @import '~bootstrap/scss/bootstrap';

    *::-webkit-scrollbar {
    width: 5px;
}

*::-webkit-scrollbar-track {
    background: white;
}

*::-webkit-scrollbar-thumb {
    background-color: #4070F4;
    border-radius: 20px;
    border: 1px solid #4070F4;
}
</style>