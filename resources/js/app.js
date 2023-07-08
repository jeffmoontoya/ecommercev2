import './bootstrap';
import { createApp } from 'vue';
import vSelect from 'vue-select';
import UserList from './components/Users/Index.vue';
import ProductList from './components/Products/Index.vue';
import CategoryList from './components/Categories/Index.vue';
import CartList from './components/Cart/Index.vue';

const app = createApp({
    components: {
        UserList,
        ProductList,
        CategoryList,
        CartList,
    }
});

app.component('v-select', vSelect);
app.mount('#app');
