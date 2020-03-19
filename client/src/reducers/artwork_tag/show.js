import { combineReducers } from 'redux';

export function error(state = null, action) {
  switch (action.type) {
    case 'ARTWORK_TAG_SHOW_ERROR':
      return action.error;

    case 'ARTWORK_TAG_SHOW_MERCURE_DELETED':
      return `${action.retrieved['@id']} has been deleted by another user.`;

    case 'ARTWORK_TAG_SHOW_RESET':
      return null;

    default:
      return state;
  }
}

export function loading(state = false, action) {
  switch (action.type) {
    case 'ARTWORK_TAG_SHOW_LOADING':
      return action.loading;

    case 'ARTWORK_TAG_SHOW_RESET':
      return false;

    default:
      return state;
  }
}

export function retrieved(state = null, action) {
  switch (action.type) {
    case 'ARTWORK_TAG_SHOW_SUCCESS':
    case 'ARTWORK_TAG_SHOW_MERCURE_MESSAGE':
      return action.retrieved;

    case 'ARTWORK_TAG_SHOW_RESET':
      return null;

    default:
      return state;
  }
}

export function eventSource(state = null, action) {
  switch (action.type) {
    case 'ARTWORK_TAG_SHOW_MERCURE_OPEN':
      return action.eventSource;

    case 'ARTWORK_TAG_SHOW_RESET':
      return null;

    default:
      return state;
  }
}

export default combineReducers({ error, loading, retrieved, eventSource });
