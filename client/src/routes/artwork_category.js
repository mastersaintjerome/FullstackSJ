import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/artwork_category/';

export default [
  <Route path="/artwork__categories/create" component={Create} exact key="create" />,
  <Route path="/artwork__categories/edit/:id" component={Update} exact key="update" />,
  <Route path="/artwork__categories/show/:id" component={Show} exact key="show" />,
  <Route path="/artwork__categories/" component={List} exact strict key="list" />,
  <Route path="/artwork__categories/:page" component={List} exact strict key="page" />
];
