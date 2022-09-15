<template>
  <div class="container mt-5">
        <div class="d-flex justify-content-between mb-5">
            <ul class="col-2">
                <li></li>
            </ul>
            <img class="col-4 img-fluid img-thumbnail rounded-circle" src="https://www.limontasport.com/wp-content/uploads/2016/03/landscape-test.jpg" alt="">
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-secondary">Contatta</button>
            <button class="btn btn-success">Scrivi una recensione</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PageShow'
}
</script>

<style lang="scss" scoped>
    li {
        list-style-type: none;
    }

    img {
        width: 300px;
    }
</style>
