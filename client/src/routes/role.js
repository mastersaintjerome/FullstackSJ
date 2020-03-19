import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/role/';

export default [
  <Route path="/roles/create" component={Create} exact key="create" />,
  <Route path="/roles/edit/:id" component={Update} exact key="update" />,
  <Route path="/roles/show/:id" component={Show} exact key="show" />,
  <Route path="/roles/" component={List} exact strict key="list" />,
  <Route path="/roles/:page" component={List} exact strict key="page" />
];
