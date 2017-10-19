<template>
    <div>
        <h3 class="text-center">Assinged Brands</h3>
        <div class="well store-box">
          <ul class="list-group checked-list-box">
        <!--       <li class="list-group-item checkbox" style="cursor: pointer;"  v-for="(item, key) in stores['data']">
                <h2>{{ stores['list'][key] }}</h2>
                <div class="form-inline">
                     <div class="checkbox inline-brands">
                        <label>
                           <input type="checkbox"> brandName
                        </label>
                      </div>
                </div>
              </li> -->
          </ul> 
        </div>
    </div>
    
</template>

<script>
    export default {
        props: ['stores'],

        mounted() {
            console.log('mounted');
            // console.log(this.stores);
            console.log(this.stores);
        }
    }
</script>
