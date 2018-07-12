<template>
    <div class="row pt-5 pb-5">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
             <div class="" v-if="promotions.length || processing">
                <div class="form-header  w-50 mn-t-01 mr-4 text-right" style="right:0; position: absolute;">
                    <h3 class="mt-2 black-text b-01" > Promociones</h3>
                    <div class="linea-pro " style="right:0; position: absolute;"></div>
                </div>
                <div>
                    <tabs class="mt-4">
                        <tab name="Bebidas" style="padding-bottom: 5px; padding-top:5px;">
                             <div class="tab-pane fade in show active p-4" id="panel2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 mb-lg-0 mb-4"  v-for="(promotion, index) in promotions"
                                                                                    :key="index">

                                            <h4 class="card-title black-text">Card title</h4>
                                            <div class="border-black align-items-center">
                                            <div class="view overlay">
                                                 
                                                <img :alt="promotion.name" :src="`images/${promotion.image}`" class="card-img-top" />
                                                <a
                                                    v-if="!logged"
                                                    :href="`/images/${promotion.image}`"
                                                    style="margin-top: 15px"
                                                    target="_blank"
                                                > 
                                                </a>
                                                <a
                                                    v-else
                                                    @click.prevent="addProductInCart(promotion.productId)"
                                                    style="margin-top: 15px; cursor: pointer"
                                                >
                                                    <div class="mask rgba-white-slight">
                                                        <div  style="right: 0px; width: auto; position: absolute; top: 0px; z-index: 1200;" class=" " >
                                                            <h5><span class="badge badge-pill danger-color">ORDENAR</span>  </h5>   
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="text-center">
                                                <div  class="bg-card" style="left: 10px; width: auto; position: absolute; bottom: 10px; z-index: 1200;" >
                                                    <h5 class="font-weight-bold white-text">
                                                            S/. {{ promotion.price }}
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
    </div>
</template>

<script>
    import CartMixin from '../mixins/cart';
    import ProductsMixin from '../mixins/products';
    import Preloader from "./Preloader";
    export default {
        components: {Preloader},
        name: "promotions-component",
        mixins: [CartMixin, ProductsMixin],
        data () {
            return {
                promotions: [],
                processing: false,
                url: '/promotions'
            }
        },
        methods: {
            prepareData (promotionsData) {
                let promotions = promotionsData.data;
                promotions.forEach(promotion => {
                    this.promotions.push({
                        id: promotion.id,
                        productId: promotion.product.id,
                        name: promotion.product.name,
                        price: promotion.price,
                        image: promotion.product.image
                    });
                });
            }
        },
        mounted () {
            window.Echo.channel('new-promotion').listen('.new-promotion-added', (e) => {
                let promotion = e.promotion;
                this.processing = true;
                setTimeout(() => {
                    this.promotions.push({
                        id: promotion.id,
                        productId: promotion.product.id,
                        name: promotion.product.name,
                        price: promotion.price,
                        image: promotion.product.image
                    });
                    this.processing = false;
                }, 1500);
            });

            window.Echo.channel('promotion-deleted').listen('PromotionDeleted', (e) => {
                let productId = e.productId;
                this.processing = true;
                setTimeout(() => {
                    const promotionIndex = this.promotions.findIndex(p => p.productId === productId);
                    if(promotionIndex > -1) {
                        this.promotions.splice(promotionIndex, 1);
                    }
                    this.processing = false;
                }, 1500);
            })
        }
    }
</script>