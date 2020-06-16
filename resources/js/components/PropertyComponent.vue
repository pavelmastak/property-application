<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <el-form :inline="true" ref="form" :model="form" label-width="100px">
                    <el-form-item label="Name">
                        <el-input v-model="form.name" clearable @input="search"></el-input>
                    </el-form-item>
                    <el-form-item label="Price">
                        <el-col :span="8">
                            <el-input v-model="form.priceFrom" style="width: 100%;" clearable
                                      @input="search"></el-input>
                        </el-col>
                        <el-col class="line text-center" :span="2">-</el-col>
                        <el-col :span="8">
                            <el-input v-model="form.priceTo" style="width: 100%;" clearable
                                      @input="search"></el-input>
                        </el-col>
                    </el-form-item>
                    <el-form-item label="Bedrooms">
                        <el-select v-model="form.bedrooms" multiple placeholder="All" @change="search">
                            <el-option
                                v-for="item in bedroomsOptions"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Bathrooms">
                        <el-select v-model="form.bathrooms" multiple placeholder="All" @change="search">
                            <el-option
                                v-for="item in bathroomsOptions"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Storeys">
                        <el-select v-model="form.storeys" multiple placeholder="All" @change="search">
                            <el-option
                                v-for="item in storeysOptions"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Garages">
                        <el-select v-model="form.garages" multiple placeholder="All" @change="search">
                            <el-option
                                v-for="item in garagesOptions"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-form>
                <el-row>
                    <el-col>
                        <template>
                            <el-table
                                v-loading="loading"
                                :data="tableData"
                                border
                                style="width: 100%">
                                <el-table-column
                                    prop="name"
                                    label="Name"
                                    sortable>
                                </el-table-column>
                                <el-table-column
                                    prop="price"
                                    label="Price"
                                    sortable>
                                </el-table-column>
                                <el-table-column
                                    prop="bedrooms"
                                    label="Bedrooms"
                                    sortable>
                                </el-table-column>
                                <el-table-column
                                    prop="bathrooms"
                                    label="Bathrooms"
                                    sortable>
                                </el-table-column>
                                <el-table-column
                                    prop="storeys"
                                    label="Storeys"
                                    sortable>
                                </el-table-column>
                                <el-table-column
                                    prop="garages"
                                    label="Garages"
                                    sortable>
                                </el-table-column>
                            </el-table>
                        </template>
                    </el-col>
                </el-row>
            </div>
        </div>
    </div>
</template>

<script>
    const api = 'http://hicaliber/api/search';
    import axios from 'axios';

    export default {
        data() {
            return {

                form: {
                    name: '',
                    priceFrom: '',
                    priceTo: '',
                    bedrooms: [],
                    bathrooms: [],
                    storeys: [],
                    garages: [],
                },

                tableData: [],
                loading: true,
                bedroomsOptions: [
                    {
                        value: 1,
                        label: '1'
                    },
                    {
                        value: 2,
                        label: '2'
                    },
                    {
                        value: 3,
                        label: '3'
                    },
                    {
                        value: 4,
                        label: '4'
                    },
                    {
                        value: 5,
                        label: '5'
                    }
                ],
                bathroomsOptions: [
                    {
                        value: 1,
                        label: '1'
                    },
                    {
                        value: 2,
                        label: '2'
                    },
                    {
                        value: 3,
                        label: '3'
                    }
                ],
                storeysOptions: [
                    {
                        value: 1,
                        label: '1'
                    },
                    {
                        value: 2,
                        label: '2'
                    },
                    {
                        value: 3,
                        label: '3'
                    }
                ],
                garagesOptions: [
                    {
                        value: 1,
                        label: '1'
                    },
                    {
                        value: 2,
                        label: '2'
                    },
                    {
                        value: 3,
                        label: '3'
                    }
                ],
            }
        },
        methods: {
            async search() {
                this.loading = true;
                await axios.get(api, {
                    params: {
                        name: this.form.name,
                        priceFrom: this.form.priceFrom,
                        priceTo: this.form.priceTo,
                        bedrooms: this.form.bedrooms,
                        bathrooms: this.form.bathrooms,
                        storeys: this.form.storeys,
                        garages: this.form.garages
                    }
                }).then(({data}) => {
                    this.tableData = data;
                    this.loading = false;
                }).catch(e => {
                    console.log(e);
                })
            }
        },
        mounted() {
            this.search();
        }
    }
</script>
