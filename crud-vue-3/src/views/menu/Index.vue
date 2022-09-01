<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>DATA POST</h4>
                        <hr>
                        <router-link :to="{ name: 'profilhotel.create' }" class="btn btn-md btn-success">TAMBAH POST
                        </router-link>

                        <table class="table table-striped table-dark mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID MENU</th>
                                    <th scope="col">kategori</th>
                                    <th scope="col">nama</th>
                                    <th scope="col">harga</th>
                                    <th scope="col">status</th>
                                    <th scope="col">deskripsi</th>
                                    <th scope="col">filename</th>
                                    <th scope="col">level</th>
                                    <th scope="col">OPTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(menu, index) in menus" :key="index">
                                    <td>{{  menu.idmenu  }}</td>
                                    <td>{{  menu.kategori  }}</td>
                                    <td>{{  menu.nama  }}</td>
                                    <td>{{  menu.harga  }}</td>
                                    <td>{{  menu.status  }}</td>
                                    <td>{{  menu.deskripsi  }}</td>
                                    <td>{{  menu.filename  }}</td>
                                    <td>{{  menu.level  }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'menu.edit', params: { id: menu.id } }"
                                            class="btn btn-sm btn-primary mr-1">EDIT</router-link>
                                        <button @click.prevent="postDelete(menu.id)"
                                            class="btn btn-sm btn-danger ml-1"> DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {

    name: 'index',

    setup() {

        //reactive state
        let menus = ref([])

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/menus')
                .then(response => {

                    //assign state posts with response data
                    menus.value = response.data.data

                }).catch(error => {
                    console.log(error.response.data)
                })

        })

        //method delete
        function postDelete(id) {

            //delete data post by ID
            axios.delete(`http://localhost:8000/api/profilhotels/${id}`)
                .then(() => {

                    //splice profihotels 
                    menus.value.splice(menus.value.indexOf(id), 1);

                }).catch(error => {
                    console.log(error.response.data)
                })

        }

        //return
        return {
            menus,
            postDelete
        }

    }

}
</script>

<style>
body {
    background: lightgray;
}
</style>