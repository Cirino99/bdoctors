<template>
  <div class="container mt-5">
        <div class="d-flex justify-content-between mb-5">
            <div class="row">
                <ul>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                    <li>questo è un testo</li>
                </ul>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <img class="img-fluid img-thumbnail rounded-circle" src="https://www.limontasport.com/wp-content/uploads/2016/03/landscape-test.jpg" alt="">
                </div>
            </div>
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
        min-width: 150px;
        min-height: 150px;
        width: 30vw;
        height: 30vw;
        object-fit: cover;
        object-position: center;
    }
</style>
