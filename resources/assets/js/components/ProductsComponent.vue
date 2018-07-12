<template>
    <div class="row pt-5 pb-5">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="">

                <div class="form-header  w-50 mn-t-01 mr-4 text-right" style="right:0; position: absolute;">
                    <h3 class="mt-2 black-text b-01" > Productos</h3>
                    <div class="linea-pro " style="right:0; position: absolute;"></div>
                </div>
                <div>
                    <tabs class="mt-4">
                        <tab name="Bebidas" style="padding-bottom: 5px; padding-top:5px;">
                             <div class="tab-pane fade in show active p-4" id="panel2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-4" v-for="(product, index) in products"  :key="index" >
                                            <h4 class="card-title black-text">Card title</h4>
                                            <div class="border-black align-items-center">
                                            <div class="view overlay">
                                                <img :alt="product.name" :src="`images/${product.image}`" class="card-img-top" />
                                                <a
                                                    v-if="!logged"
                                                    :href="`images/${product.image}`"
                                                    style="margin-top: 15px"
                                                    target="_blank"
                                                > 
                                                </a>
                                                <a
                                                    v-else
                                                    @click.prevent="addProductInCart(product.id)"
                                                    style="margin-top: 15px; cursor: pointer"
                                                >
                                                    <div class="mask rgba-white-slight">
                                                        <div  style="right: 0px; width: auto; position: absolute; top: 0px; " class=" " >
                                                            <h5><span class="badge badge-pill danger-color">ORDENAR</span>  </h5>   
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="text-center">
                                                <div  class="bg-card" style="left: 10px; width: auto; position: absolute; bottom: 10px;" >
                                                    <h5 class="font-weight-bold white-text">
                                                            S/. {{ product.price }}
                                                    </h5> 
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </tab>
                        <tab name="Pollos a la brasa">
                             <div  class="card-body">
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">No hay productos disponibles!</h4>
                                    <p>Aún no hay productos, pero pueden aparecer en cualquier momento!</p>
                                </div>
                            </div>
                        </tab>
                        
                        <tab  name="Parrillas">
                           <div  class="card-body">
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">No hay productos disponibles!</h4>
                                    <p>Aún no hay productos, pero pueden aparecer en cualquier momento!</p>
                                </div>
                            </div>
                        </tab>
                        <tab name="Tragos">
                            <div  class="card-body">
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading">No hay productos disponibles!</h4>
                                    <p>Aún no hay productos, pero pueden aparecer en cualquier momento!</p>
                                </div>
                            </div>
                        </tab>
                    </tabs>
                </div>
               
              

            </div><!-- end card-->
        </div>
        <div class="container09">
            <div class="row">
                <div class="col-3  p-2 d-flex justify-content-center p-4 border-mesa">
                        <div class="bg-mesa redondear" id="otro_div" onclick="myFunction()">
                        <img src="images/mesa.svg" class="w-100" alt="">
                        </div>  
                </div>
          
            </div>
            
            <div id="padre">
        <div id="hijo1"> asd </div>
        <div id="hijo2"> qwe </div>
        <div id="hijo3"> asd </div>
    </div>
 
    ----asdasdas---
 
    <div id="otro_div"> qqe </div>



        </div>
    </div>


</template>

<script>
   
    import CartMixin from '../mixins/cart';
    import ProductsMixin from '../mixins/products';
    import Preloader from "./Preloader";
    export default {
        components: {Preloader},
        name: "products-component",
        mixins: [CartMixin, ProductsMixin],
        data () {
            return {
                products: [],
                processing: false,
                url: '/products'
            }
        },
        methods: {
            prepareData (productsData) {
                let products = productsData.data;
                products.forEach(product => {
                    this.products.push({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        image: product.image
                    });
                });
            }
        },
        mounted () {
            window.Echo.channel('product-added').listen('ProductAdded', (e) => {
                let product = e.product;
                this.processing = true;
                setTimeout(() => {
                    this.products.push({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        image: product.image
                    });
                    this.processing = false;
                }, 1500);
            });

            window.Echo.channel('product-deleted').listen('ProductDeleted', (e) => {
                let productId = e.id;
                console.log("product deleted...");
                this.processing = true;
                setTimeout(() => {
                    const productIndex = this.products.findIndex(p => p.id === productId);
                    if(productIndex > -1) {
                        this.products.splice(productIndex, 1);
                    }
                    this.processing = false;
                }, 1500);
            });
        }
    }
</script>