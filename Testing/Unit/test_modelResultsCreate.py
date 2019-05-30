import pytest
from sklearn.decomposition import LatentDirichletAllocation

def test_model_create():
    assert type(LatentDirichletAllocation(n_components=10, max_iter=10, learning_method='online')) == "<class 'sklearn.decomposition.online_lda.LatentDirichletAllocation'>"

test_model_create()
