// lazy load routes
const page = (path) => {
  return () => import(`../pages/${path}`).then((m) => m.default || m);
};

// exports routes
export default [
    { path: "/", redirect: { name: "home" } },
    { path: "/home", name: "home", component: page("Home.vue") },
    { path: "/login", name: "login", component: page("Login.vue") },
    { path: "/register", name: "register", component: page("Register.vue") },
    { path: "/categories/products/:id", name: "products", component: page("CategoryProducts.vue") },
    { path : '/categories/singleproducts/:id', name : 'detailproduct', component : page('ProductDetails.vue') },
    { path : '/add-category', name : 'addcategory', component : page('AddCategory.vue') },
    { path : '/edit-category/:id', name : 'editcategory', component : page('EditCategory.vue') },
    { path : '/edit-product/:id', name : "editproduct", component : page('EditProduct.vue') },
    { path : '/add-product', name : 'addproduct', component : page('AddProduct.vue') },
    { path : '/products/variant/:id', name : 'productvariant', component : page('ProductVariant.vue') },
    { path : '/add-variant/:id', name : 'addvariant', component : page('AddVariant.vue') },
    { path : '/edit-variant/:id', name : 'editvariant', component : page('EditVariant.vue') }
];
