import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/artwork/';

export default [
  <Route path="/artworks/create" component={Create} exact key="create" />,
  <Route path="/artworks/edit/:id" component={Update} exact key="update" />,
  <Route path="/artworks/show/:id" component={Show} exact key="show" />,
  <Route path="/artworks/" component={List} exact strict key="list" />,
  <Route path="/artworks/:page" component={List} exact strict key="page" />
];
