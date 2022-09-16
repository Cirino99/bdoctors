<template>
    <div class="">
        <div class="container-fluid">
            <div class="d-flex">

                <div class="col-2 m-2" style="min-width: 250px;">


                    <div class="card">
                        <div class="card-header">
                            <h3>Filtra per:</h3>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Città:</strong><br>
                                <form class="d-flex form-inline my-2 my-lg-0">
                                    <input v-model="search" @keyup.enter="searchDoctor" class="form-control mr-sm-2"
                                        type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </li>

                            <li class="list-group-item"><strong>Specializzazione:</strong><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Radiologia
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Chirurgia
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Pediatria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Oncologia
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Neurochirurgia
                                    </label>
                                </div>
                            </li>
                            <!-- <li class="list-group-item">A third item</li> -->
                        </ul>
                    </div>


                </div>

                <div class="d-flex flex-wrap justify-content-center col-9 ms-5">
                    <CardDoctor v-for="(doctor, index) in doctors" :key="index" :doctor="doctor" />
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import CardDoctor from '../components/CardDoctor.vue'

export default {
    name: 'PageAdvanceSearch',

    data() {
        return {
            doctors: [],
        }
    },

    components: {
        CardDoctor,
    },

    created() {
        axios.get('/api/doctors')
            .then(res => {
                if (res.data.success) {
                    this.doctors = res.data.result;
                    console.log(this.doctors);
                }
            })
    }
}
</script>

<style lang="scss" scoped>
.form-check {
    display: inline-block;
}
</style>
