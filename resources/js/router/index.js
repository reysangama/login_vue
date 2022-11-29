import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
//MANTENIMIENTO
import User from '../pages/maintenance/User';
import Profile from '../pages/maintenance/Profile';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Books from '../components/Books';
import AddBook from '../components/AddBook';
import EditBook from '../components/EditBook';

export const routes = [
    {
        name: 'login',
        path: '/',
        component: Login
    },
    
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    // {
    //     name: 'login',
    //     path: '/login',
    //     component: Login
    // },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard,
        children: [
            {
                name: 'User',
                path: '/user',
                component: User
            },
            {
                name: 'profile',
                path: '/profile',
                component: Profile
                
            }
        ]
    },
    {
        name: 'books',
        path: '/books',
        component: Books
    },
    {
        name: 'addbook',
        path: '/books/add',
        component: AddBook
    },
    {
        name: 'editbook',
        path: '/books/edit/:id',
        component: EditBook
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
