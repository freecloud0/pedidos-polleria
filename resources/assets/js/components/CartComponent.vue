<template>
    <div class="row pt-5">
     
        <div class="col-12">
            <div class="">
                
                <div class="form-header  w-50 mn-t-01 mr-4 text-right" style="right:0; position: absolute;">
                    <h3 class="mt-2 black-text b-01" > Carrito</h3>
                    <div class="linea-pro " style="right:0; position: absolute;"></div>
                </div> 
                <br>  
                <preloader :center="true" :processing="processing" v-if="processing"> </preloader>

                <div v-else>
                    <div class="card-body " v-if="products.length">
                        <table class="table  white  table-hover table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class=" sise-t-15 b-01">Producto</th>
                                <th scope="col" class=" sise-t-15 b-01">Imagen</th>
                                <th scope="col" class=" sise-t-15 b-01">Precio</th>
                                <th scope="col" class=" sise-t-15 b-01">Cantidad</th>
                                <th scope="col" class=" sise-t-15 b-01">Cancelar Pedido</th>
                                
                                
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <td>{{ product.name }}</td>
                                <td>
                                    <img height="40" :src="`images/${product.image}`" />
                                </td>
                                <td >
                                    <div class="sm-02 sise-t-21 mt-2">
                                        {{ product.price }}
                                    </div>
                                </td>
                                <td>
                                    <div class="row text-center">
                                        <div class="col-4  sm-02">
                                            <button class="btn btn-warning btn-sm" @click="decrementProductInCart(product.id)">
                                                <i class="fa fa-minus bigfonts" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="col-4  sm-02">
                                            <div class="  mt-2 sise-t-21">
                                                {{ product.qty }}
                                                
                                            </div>
                                        </div>
                                        <div class="col-4  sm-02">
                                            <button class="btn btn-primary btn-sm" @click="addProductInCart(product.id)">
                                                <i class="fa fa-plus bigfonts" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" @click="removeProductInCart(product.id)">
                                        <i class="fa fa-trash bigfonts" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="1">
                                    <button class="btn btn-outline-dark" @click="processCart">
                                        Procesar pedido
                                    </button>
                                </td>
                                <td colspan="1" class="card ">
                                     <h3 class="mt-2 black-text b-01" > 
                                         Total: S/. {{ totalCost(products) }}
                                    </h3> 
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body" v-else>
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">No hay productos en el carrito!</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Preloader from './Preloader';
    import CartMixin from '../mixins/cart';
    export default {
        name: "cart-component",
        mixins: [CartMixin],
        components: {
            Preloader
        },
        props: {
            user_id: {
                type: Number,
                required: true
            }
        },
        data () {
            return {
                products: [],
                processing: false
            }
        },
        mounted () {
            this.$http.get('/cart').then(cartData => {
                cartData.data.map(product => {
                    this.products.push(product);
                });
            });

            window.Echo.private(`cart-updated.${this.user_id}`).listen('UserCart', (e) => {
                this.processing = true;
                setTimeout(() => {
                    let cart = e.cart;
                    this.products = [];
                    cart.map(product => {
                        this.products.push(product);
                    });
                    this.processing = false;
                }, 1200);
            });
        }
    }
</script>
